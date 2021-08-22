import Api from "./Base/BaseModel";

export default class SaidasDeCampo {
    constructor(
        id = null,
        sigla = '',
        nome = '',
        latitude = null,
        longitude = null
    ) {
        this.id = id;
        this.sigla = sigla;
        this.nome = nome;
        this.latitude = latitude;
        this.longitude = longitude;

        this.api = '/api/saidas_de_campo';
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

        let saidasDeCampo = new SaidasDeCampo();
        return Api.get(saidasDeCampo.api, filtros);
    }
}
