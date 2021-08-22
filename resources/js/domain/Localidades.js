import Api from "./Base/BaseModel";

export default class Localidades {
    constructor(
        id = null,
        nome = '',
        numero = '',
        bairroId = '',
    ) {
        this.id = id;
        this.nome = nome;
        this.numero = numero;
        this.bairro_id = bairroId;
        this.bairro = {
           cidade: {
               estado: {}
           }
        };

        this.api = '/api/localidades';
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

        let localidades = new Localidades();
        return Api.get(localidades.api, filtros);
    }
}
