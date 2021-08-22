import Api from "./Base/BaseModel";

export default class Privilegios {
    constructor(
        id = null,
        nome = '',
    ) {
        this.id = id;
        this.nome = nome;
        this.acessos = {};

        this.api = '/api/privilegios';
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

    listarAcessos(id) {
        return Api.get( this.api + "/" +id + "/acessos");
    }

    static todos(filtros = {}) {
        filtros.paginated = 0;

        let privilegios = new Privilegios();
        return Api.get(privilegios.api, filtros);
    }
}
