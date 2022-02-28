import Api from "./Base/BaseModel";
import querystring from "querystring";
import axios from "axios";

export default class Locality extends Api {
    static apiUrl = '/api/localities'

    static new() {
        return {
            id: null,
            name: null,
            service_group_id: null,
            service_group: {},
            cards: []
        }
    }

    static async cards(id, params = {}) {
        this.url = this.apiUrl + '/' + id + '/cards?' + querystring.stringify(params)

        return await axios.get(this.url)
            .then(response => response.data)
    }
}
