export async function request(fn, notify) {
	let data = null;
	let error = null;
	try {
		const response = await fn()
		data = response.data
		const method = response.config.method
		const title = data?.title ?? 'Exito!';
		const type = data?.type ?? 'success';
		const message = data?.message;
		const isGet = method === 'get'
		const noNotify = isGet && !notify
		const notification = noNotify ? false : notify ?? true

		if (notification) {
			console.log({
				title,
				message,
				type
			})
		}


	} catch (e) {
		const title = e.response?.data?.title ?? 'Error!';
		const message = e.response?.data?.message ?? e.message ?? e.error ?? Object.values(e?.errors)[0][0];

		if(e.response?.status == 422){
			console.error({ title: title, message: e.response?.data?.error, type: 'error', })	
		}else{
			console.error({ title: title, message: message, type: 'error', })
		}

		error = e;
	}
	return { data, error }
}
