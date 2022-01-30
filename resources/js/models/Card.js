import Api from "./Base/BaseModel";

export default class ServiceGroup extends Api {
    static apiUrl = '/api/cards'

    static new() {
        return {
            id: null,
            order: null,
            locality_id: null,
            locality: {}
        }
    }
}
