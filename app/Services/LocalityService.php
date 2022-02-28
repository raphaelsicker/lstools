<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Card;
use App\Models\Locality;

class LocalityService
{
    private int $order = 1;

    public function __construct(
        private Locality $locality,
        private Card $card,
        private Address $address
    ) {}

    public function save(array $locality, int $id = null)
    {
        $model = $this->locality
            ->findOrNew($id)
            ->fill($locality);

        if(!$model->save()) {
            return false;
        }

        $model->refresh();
        $this->saveCards($locality['cards'], $model->id);
        return $model;
    }

    private function saveCards(array $cards, int $localityId): void
    {
        foreach ($cards as $card) {
            $this->saveCard($card, $localityId);
        }
    }

    private function saveCard(
        array $card,
        int $localityId
    ): bool {
        if(empty($card['addresses'])) {
            return (bool) $this->card
                ->find($card['id'])
                ?->delete();
        }

        $card['locality_id'] = $localityId;
        $card['order'] = $this->order;
        $this->order++;

        $savedCard = $this->card::store($card);
        return $this->saveAddress($card['addresses'], $savedCard->id);
    }

    private function saveAddress(
        array $addresses,
        int $cardId
    ): bool {
        foreach ($addresses as $address) {
            $this->address->where('id', $address['id'])
                ->update(['card_id' => $cardId]);
        }
        return true;
    }
}