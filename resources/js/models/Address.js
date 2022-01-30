import Api from "./Base/BaseModel";

export default class ServiceGroup extends Api {
    static apiUrl = '/api/cards'

    static new() {
        return {
            id: null,
            street: null,
            number: null,
            complement: null,
            reference: null,
            district: null,
            latitude: null,
            longitude: null,
            city_id: null,
            card_id: null,
            city: {},
            card: {}
        }
    }
}
