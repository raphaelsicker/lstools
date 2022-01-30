import Api from "./Base/BaseModel";

export default class ServiceGroup extends Api {
    static apiUrl = '/api/localities'

    static new() {
        return {
            id: null,
            name: null,
            service_group_id: null,
            service_group: {},
            cards: {}
        }
    }
}
