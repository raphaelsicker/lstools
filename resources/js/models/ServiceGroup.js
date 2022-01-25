import Api from "./Base/BaseModel";

export default class ServiceGroup extends Api {
    static apiUrl = '/api/service-groups'

    static new() {
        return {
            id: null,
            name: null,
            shortname: null,
            color: null
        }
    }
}
