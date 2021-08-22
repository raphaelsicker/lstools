import Api from "./Base/BaseModel";

export default class Bairros {
    constructor(
        id = null,
        nome = '',
        cidadeId = null,
    ) {
        this.id = id;
        this.nome = nome;
        this.cidade_id = cidadeId;
        this.cidade = {
            estado_id: null
        };

        this.api = '/api/bairros';
    }

    listar(filtros = {}) {
        return Api.get(this.api, filtros);
    }

    encontrar(id) {
        return Api.get( this.api + "/" +id);
    }

    salvar() {
        if(this.id) {
            return Api.put(this.api + "/" + this.id, this);
        }
        return Api.post(this.api, this);
    }

    deletar() {
        return Api.delete(this.api + "/" + this.id);
    }

    static todos(filtros = {}) {
        filtros.paginated = 0;

        let bairros = new Bairros();
        return Api.get(bairros.api, filtros);
    }
};
