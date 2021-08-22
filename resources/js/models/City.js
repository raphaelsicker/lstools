import Api from "./Base/BaseModel";

export default class City extends Api {
    static apiUrl = '/api/cities'

    static new() {
        return {
            id: null,
            name: null,
            uf_id: null,
            uf: {}
        }
    }
}
