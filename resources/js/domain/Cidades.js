import Api from "./Base/BaseModel";

export default class Cidades {
    constructor(
        id = null,
        nome = '',
        estadoId = null,
        capital = null
    ) {
        this.id = id;
        this.nome = nome;
        this.estado_id = estadoId;
        this.capital = capital;
        this.estado = {};

        this.api = '/api/cidades';
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

        let cidades = new Cidades();
        return Api.get(cidades.api, filtros);
    }
}
