import Api from "./Base/BaseModel";

export default class Uf extends Api {
    static apiUrl = '/api/ufs'

    constructor() {
        super();

        this.id = null;
        this.name = null;
    }
}
