import Api from "./Base/BaseModel";

export default class Estados {
    constructor(
        id = null,
        sigla = '',
        nome = '',
    ) {
        this.id = id;
        this.sigla = sigla;
        this.nome = nome;

        this.api = '/api/estados';
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

        let estados = new Estados();
        return Api.get(estados.api, filtros);
    }
}
