// Función para obtener el token de autenticación
async function getToken() {
    try {
      const response = await fetch('https://api.vamas.online/v1/getTokenSunat');
      if (!response.ok) throw new Error('Error al obtener el token');
      const token = await response.text();
      return token;
    } catch (error) {
      console.error('Error al obtener el token:', error);
    }
  }
  
  // Función para consultar la información de una persona usando el DNI
  async function getDniInfo(document) {
    try {
      // Primero obtenemos el token de autenticación
      const token = await getToken();
      if (!token) return;
  
      // Construimos la URL con el DNI
      const url = `https://api-cpe.sunat.gob.pe/v1/contribuyente/parametros/personas/${document}`;
      
      // Hacemos la solicitud a la API con el token en los encabezados
      const response = await fetch(url, {
        headers: {
          'Authorization': `Bearer ${token}`
        }
      });
  
      // Convertimos la respuesta a JSON
      const data = await response.json();
  
      console.log(data);
    } catch (error) {
      console.error('Error en la solicitud:', error);
    }
  }
  
  // Llamamos a la función con el número de documento
  getDniInfo('77420150');
  