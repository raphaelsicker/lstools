import Model from "./Base/BaseModel";

export default class Estado extends Model {
    static entity = 'estados'
    static apiUrl = '/api/estados'

    static fields() {
        return {
            id: this.attr(null),
            sigla: this.attr(''),
            nome: this.attr(''),
            created_at: this.attr(null),
            updated_at: this.attr(null)
        }
    }
}
