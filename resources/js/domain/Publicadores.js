import Api from "./Base/BaseModel";

export default class Publicadores {
    constructor(
        id = null,
        nome = '',
        saidaDeCampoId = null,
        saidaDeCampo = {},
        enderecos = {},
        contatos = {},
    ) {
        this.id = id;
        this.nome = nome;
        this.saida_de_campo_id = saidaDeCampoId;
        this.saida_de_campo = saidaDeCampo;
        this.enderecos = enderecos;
        this.contatos = contatos;

        this.api = '/api/publicadores';
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

        let publicadores = new Publicadores();
        return Api.get(publicadores.api, filtros);
    }
};
