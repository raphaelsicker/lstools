<?php

namespace App\Services;

use App\Helpers\Arr;
use App\Models\Address;
use App\Models\Card;
use App\Models\Locality;
use App\Models\ServiceGroup;
use Illuminate\Database\Eloquent\Collection;

class CardService
{
    public function __construct(private ServiceGroup $serviceGroup) {}

    public function toPrint($filters): array
    {
        $serviceGroupId = Arr::get($filters, 'service_group_id');
        $localityId = Arr::get($filters, 'locality_id');
        $cardId = Arr::get($filters, 'card_id');

        $serviceGroups = $this->getServiceGroups($serviceGroupId);

        foreach($serviceGroups as $serviceGroup) {
            $localities = $this->getLocalities($serviceGroup, $localityId);

            foreach ($localities as $locality) {
                $cards = $this->getCards($locality, $cardId);

                foreach($cards as $card) {
                    $maps[] = $this->getMaps($card);
                }
            }
        }

        return $this->chunckMaps($maps ?? []);
    }

    /**
     * @param int|null $serviceGroupId
     * @return ServiceGroup[]|Collection
     */
    private function getServiceGroups(?int $serviceGroupId): array|Collection
    {
        return $this->serviceGroup
            ->when($serviceGroupId, fn($query, $serviceGroupId) => $query->where('id', $serviceGroupId))
            ->get();
    }

    /**
     * @param ServiceGroup $serviceGroup
     * @param int|null $localityId
     * @return Locality[]|Collection
     */
    private function getLocalities(
        ServiceGroup $serviceGroup,
        ?int $localityId
    ): Collection | array {
        return $serviceGroup
            ->localities()
            ->without(['serviceGroup'])
            ->when($localityId, fn($query, $localityId) => $query->where('id', $localityId))
            ->get();
    }

    /**
     * @param Locality $locality
     * @param int|null $cardId
     * @return Card[]|Collection
     */
    private function getCards(
        Locality $locality,
        ?int $cardId
    ): Collection | array {
        return $locality
            ->cards()
            ->when($cardId, fn($query, $cardId) => $query->where('id', $cardId))
            ->get();
    }

    /**
     * @param Card $card
     * @return array
     */
    private function getMaps(Card $card): array
    {
        $addresses = $card->addresses()
            ->without(['city', 'card'])
            ->get();

        return [
            'serviceGroup' => $card->locality->serviceGroup->shortname,
            'color' => $card->locality->serviceGroup->color,
            'locality' => $card->locality->name,
            'order' => $card->order,
            'addresses' => $this->getAddresses($addresses)
        ];
    }

    /**
     * @param Collection $cardAddresses
     * @return array
     */
    private function getAddresses(Collection $cardAddresses): array
    {
        $gMapColors = ['red', 'blue', 'green', 'yellow', 'purple'];

        /** @var Address $address */
        foreach($cardAddresses as $key => $address) {
            $addresses[] = [
                'label' => $key + 1,
                'color' => $gMapColors[$key] ?? 'blue',
                'complete' => $address->complete,
                'reference' => $address->reference,
                'lat' => $address->lat,
                'lng' => $address->lng,
            ];
        }

        return $addresses ?? [];
    }


    /**
     * @param array $maps
     * @return mixed[]
     */
    private function chunckMaps(array $maps): array
    {
        return collect($maps)
            ->chunk(2)
            ->toArray();
    }
}