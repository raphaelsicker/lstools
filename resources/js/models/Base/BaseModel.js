import axios from "axios";
const querystring = require('querystring');

export default class BaseModel {
    static url = ''
    static apiUrl = ''

    static async all(params = {}) {
        return await this.get({per_page: "false",...params})
    }

    static async get(params = {}, config = {}) {
        if(params === {}) {
            return await axios.get(this.apiUrl, config)
                .then(response => response.data);
        }
        
        const url = this.apiUrl + '?' + querystring.stringify(params)
        return await axios.get(url, config)
            .then(response => response.data);
    }

    static async find(id, params = {}) {
        this.url = this.apiUrl + '/' + id + '?' + querystring.stringify(params)

        return await axios.get(this.url)
            .then(response => response.data)
    }

    static async save(data) {
        if(data.id) {
            return await this.put(data.id, data)
        }

        return await this.post(data)
    }

    static async post(data) {
        return axios.post(this.apiUrl, data)
            .then(response => response.data)
            .catch(response => response)
    }

    static async put(id, data) {
        return axios.put(this.apiUrl + '/' + id + '?', data)
            .then(response => response.data)
            .catch(response => response)
    }

    static async delete(id, params = {}, config = {}) {
        this.url = this.apiUrl + '/' + id + '?' + querystring.stringify(params)

        return axios.delete(this.url, config)
            .then(response => response.data)
    }
};
