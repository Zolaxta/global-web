# Contexto del Proyecto: Portal de Videojuegos (Examen Práctico)

## Stack Tecnológico
- **Backend:** PHP con Laravel.
- **Base de Datos:** PostgreSQL.
- **Entorno:** Docker (Laravel Sail) en macOS.
- **Frontend / Vistas:** Laravel Blade. Prohibido usar frameworks reactivos de JS para las vistas principales.

## Reglas de Arquitectura (Patrón MVC)
1. **Roles de Usuario:** El sistema requiere distinguir entre cuentas de Jugador y de Administrador/Desarrollador.
2. **Panel Administrativo:** Rutas protegidas exclusivas para el rol de administrador, donde se gestionan las cuentas y se asignan puntos de bonificación.
3. **Catálogo y Canje:** Los usuarios pueden gastar sus puntos en recompensas.
4. **Notificaciones SSR:** REQUISITO ESTRICTO. La notificación de "artículo adquirido" al realizar un canje debe ser renderizada por el Framework Backend (Blade), no mediante fetch/AJAX asíncrono puro en el cliente.

## Directrices de Código
- Usar Eloquent ORM para toda la interacción con PostgreSQL.
- Mantener los controladores delgados y delegar la lógica compleja si es necesario.
- Escribir código limpio y fácil de documentar para el reporte técnico final.