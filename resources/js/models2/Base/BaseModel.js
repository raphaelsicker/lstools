import {Model} from "@vuex-orm/core";
const querystring = require('querystring');

export default class BaseModel extends Model {
    static apiUrl = ''
    static error

    static async get(params = {}) {
        let apiUrl = this.apiUrl

        if(params !== {}) {
            apiUrl += '?' + querystring.stringify(params)
        }

        return await this.api().get(apiUrl)
            .then(response => response.response.data)
            .catch(response => response.response)
    }

    static async find(id) {
        return await this.api().get(this.apiUrl + '/' + id)
            .then(response => response.response)
            .catch(response => response.response)
    }

    static async post(data) {
        return await this.api().post(this.apiUrl, data)
            .then(response => response.response.data)
            .catch(error => error)
    }

    static async put(data, id= null) {
        return await this.api().put(`${this.apiUrl}/${id}`, data)
            .then(response => response.response.data)
            .catch(error => error)
    }

    static async destroy(id) {
        return await this.api().delete(this.apiUrl + '/' + id)
            .then(response => response.response)
            .catch(response => response.response)
    }

    static fetch() {
        return this.api().get(this.apiUrl, {
            dataTransformer: (response) => {
                return response.data.data
            }
        });
    }

    static fetchById(id) {
        return this.api().get(`${this.apiUrl}/${id}`,  {
            dataTransformer: (response) => {
                return response.data
            }
        })
    }

    static save(data, id= null) {
        if(id) {
            this.update({
                where: id,
                data
            })

            this.api().put(`${this.apiUrl}/${id}`, data, {
                dataTransformer: (response) => {
                    return response.data
                }
            })
        }

        this.create(data)
        this.api().post(this.apiUrl, data)
    }
}
