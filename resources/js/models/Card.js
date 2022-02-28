import Api from "./Base/BaseModel";
import Locality from "./Locality";

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
}
