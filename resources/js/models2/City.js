import Model from "./Base/BaseModel";

export default class City extends Model {
    static entity = 'cities'
    static apiUrl = '/api/cities'

    static fields() {
        return {
            id: this.attr(null),
            name: this.attr(''),
            ibge: this.attr(''),
            created_at: this.attr(null),
            updated_at: this.attr(null),
            uf: this.attr({}),
        }
    }
}