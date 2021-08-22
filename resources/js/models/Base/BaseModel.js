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

    static async post(data) {
        return axios.post(this.apiUrl, data)
            .then(response => response.data)
    }

    static async put(data = {}) {
        return axios.put(this.apiUrl, data)
            .then(response => response.data)
    }

    static async delete(id, config = {}) {
        this.url = this.apiUrl + '/' + id + '?' + querystring.stringify(params)

        return axios.delete(this.url, config)
            .then(response => response.data)
    }
};
