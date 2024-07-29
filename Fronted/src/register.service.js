import axios from "axios";

export function RegisterUser(payload){
	return axios.post(`/api/register-user`, payload)
}