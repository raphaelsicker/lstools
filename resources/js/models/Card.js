import Api from "./Base/BaseModel";
import Locality from "./Locality";
import querystring from "querystring";
import axios from "axios";

export default class Card extends Api {
    static apiUrl = '/api/cards'

    static new() {
        return {
            id: null,
            order: null,
            locality_id: null,
            locality: Locality.new(),
            addresses: []
        }
    }

    static async toPrint(params = {}) {
        return await this.post(params, '/to-print')
    }
}
