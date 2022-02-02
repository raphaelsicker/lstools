import Api from "./Base/BaseModel";

export default class ServiceGroup extends Api {
    static apiUrl = '/api/addresses'

    static new() {
        return {
            id: null,
            street: null,
            number: null,
            complement: null,
            reference: null,
            district: null,
            lat: -22.5127163,
            lng: -41.918432,
            city_id: null,
            card_id: null,
            city: {uf: {}},
            card: {}
        }
    }
}
