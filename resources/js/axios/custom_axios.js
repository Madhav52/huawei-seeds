import axios from 'axios';

let baseURL = process.env.MIX_APP_BASE_URL
const custom_axios = axios.create({
    baseURL: baseURL
})
export default custom_axios