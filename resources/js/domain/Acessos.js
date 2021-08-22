import Api from "./Base/BaseModel";

export default class Acessos {
    static menus() {
        return Api.get( '/api/menus');
    }

    listar(filtros = {}) {
        return Api.get(this.api, filtros);
    }

    encontrar(id) {
        return Api.get( this.api + "/" +id);
    }
}
