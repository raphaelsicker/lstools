import Api from "./Base/BaseModel";

export default class Menu extends Api {
    static apiUrl = '/api/menus'

    constructor() {
        super();

        this.items = [];
    }
}
