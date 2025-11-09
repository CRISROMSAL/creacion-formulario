Este ejercicio consta de dos partes, uno es la creacion de un formulario tradicional y el otro es la creación de un formulario con PI REST.

El formulario tradicional:
-El formulario envía datos y recarga la página completa
-El servidor PHP genera el HTML del recibo
-La página cambia completamente (nueva URL)
-Comunicación síncrona (esperas a que cargue)

El formulario con PI REST:
El formulario NO recarga la página
JavaScript (fetch) envía datos en segundo plano
PHP devuelve JSON (datos), NO HTML
JavaScript toma el JSON y genera el HTML del recibo
Comunicación asíncrona (la página sigue funcionando)
