import Api from "./Base/BaseModel";

export default class Uf extends Api {
    static apiUrl = '/api/ufs'

    static new() {
        return {
            id: null,
            name: null,
            uf: null
        }
    }
}
