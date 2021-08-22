import axios from "axios";
const querystring = require('querystring');

export default class BaseModel {
    static get(url, params = {}, config = {}) {
        if(params === {}) {
            return axios.get(url, config);
        }

        return axios.get(
            url + '?' + querystring.stringify(params),
            config
        );
    }

    static post(url, data) {
        return axios.post(url, data);
    }

    static put(url, data = {}) {
        return axios.put(url, data);
    }

    static delete(url, config = {}) {
        return axios.delete(url, config);
    }
};
