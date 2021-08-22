import Api from "./Base/BaseModel";

export default class TiposDeContato {
    constructor(
        id = null,
        nome = '',
        formatacao = '',
        tipo = {}
    ) {
        this.id = id;
        this.nome = nome;
        this.formatacao = formatacao;
        this.tipo = tipo;

        this.api = '/api/tipos_de_contato';
    }

    listar(filtros = {}) {
        return Api.get(this.api, filtros);
    }

    encontrar(id) {
        return Api.get( this.api + "/" +id);
    }

    salvar() {
        if(this.id) {
            return Api.put(this.api + "/" + this.id, this)
        }
        return Api.post(this.api, this);
    }

    deletar() {
        return Api.delete(this.api + "/" + this.id);
    }

    static todos(filtros = {}) {
        filtros.paginated = 0;

        let tiposDeContato = new TiposDeContato();
        return Api.get(tiposDeContato.api, filtros);
    }
}
