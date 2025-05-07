import axios from "axios";

const appUri = 'http://localhost:5173';
const apiURL = 'http://localhost:8000/api/';

const axiosInstance = axios.create({
    baseURL: apiURL,
    timeout: 20000,
});

axiosInstance.interceptors.request.use(
    function (config) {
        config.headers["Authorization"] = `Bearer ${localStorage.getItem(
            "access_token"
        )}`;

        return config;
    },
    function (error) {
        
        return Promise.reject(error);
    }
);

axiosInstance.interceptors.response.use(
    function (response) {
        // Any status code that lie within the range of 2xx cause this function to trigger

        return response;
    },
    function (error) {
        // Any status codes that falls outside the range of 2xx cause this function to trigger
        if (error.code === "ERR_NETWORK") {
            window.location.href = `${appUri}/network-error`;
        } 

        return Promise.reject(error);
    }
);

export default {
    install (app) {
        app.config.globalProperties.$http = axiosInstance
    }
};




