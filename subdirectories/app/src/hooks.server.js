import { redirect } from '@sveltejs/kit';
export const handle = async({event , resolve})=>{
  const api_token = event.cookies.get('api_token');
  const is_admin = event.cookies.get('is_admin');
  event.locals.api_token = api_token
  if(api_token && event.url.pathname.startsWith('/auth') && !is_admin){
    throw redirect(302,'/')
  } else if(api_token || event.url.pathname.startsWith('/auth'))
  {
    event.locals.api_token = 'auth';
    return resolve(event)
  }
  throw redirect(302,'/auth')
}

