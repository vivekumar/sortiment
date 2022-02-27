const express = require('express');
const app = express();
const server = require('http').createServer(app);
require('dotenv').config();
const mysql = require('mysql');
const port = process.env.APP_PORT;
const db = mysql.createConnection({
    host: process.env.DB_HOST,
    user: process.env.DB_USERNAME,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_DATABASE
});

const io = require('socket.io')(server, {
    cors: { origin: "*" }
});

io.on('connection', (socket) => {
    socket.on('sendChatToServer', (msgObj) => {
        db.query("INSERT INTO chats SET admin_id=" + msgObj.admin_id + ", user_id =" + msgObj.user_id + ", message=" + db.escape(msgObj.message) + ", sender='" + msgObj.sender + "', attachment=" + msgObj.attachment + ", datetime= NOW(), created_at=NOW()", (error, result) => {
            if (error) {
                throw error
            } else {
                let sql = "SELECT c.id, c.admin_id, c.user_id, c.message, c.attachment, c.sender, c.datetime, a.name AS admin_name, a.profile_photo_path AS admin_profile_photo_path, u.name AS user_name, u.profile_photo_path AS user_profile_photo_path FROM chats c LEFT JOIN admins a ON (c.admin_id = a.id) LEFT JOIN users u ON (c.user_id = u.id) WHERE c.id = " + result.insertId;

                db.query(sql, (error, result) => {
                    if (!error) {
                        socket.broadcast.emit('sendChatToClient', result);
                    }
                });
            }
        });
    });

    socket.on('sendChatToServerCompanyAndEmployee', (msgObj) => {
        db.query("INSERT INTO chats SET admin_id=" + msgObj.admin_id + ", user_id =" + msgObj.user_id + ", message=" + db.escape(msgObj.message) + ", sender='" + msgObj.sender + "', attachment=" + msgObj.attachment + ", datetime= NOW(), created_at=NOW()", (error, result) => {
            if (error) {
                throw error
            } else {
                let sql = "SELECT c.id, c.admin_id, c.user_id, c.message, c.attachment, c.sender, c.datetime, a.name AS admin_name, a.profile_photo_path AS admin_profile_photo_path, u.name AS user_name, u.profile_photo_path AS user_profile_photo_path FROM chats c LEFT JOIN admins a ON (c.admin_id = a.id) LEFT JOIN users u ON (c.user_id = u.id) WHERE c.id = " + result.insertId;

                db.query(sql, (error, result) => {
                    if (!error) {
                        socket.broadcast.emit('sendChatToClientCompanyAndEmployee', result);
                    }
                });
            }
        });
    });
    socket.on('sendChatToServerAdminAndEmployee', (msgObj) => {
        db.query("INSERT INTO chat_employee_admins SET admin_id=" + msgObj.admin_id + ", employee_id =" + msgObj.employee_id + ", message=" + db.escape(msgObj.message) + ", sender='" + msgObj.sender + "', attachment=" + msgObj.attachment + ", datetime= NOW(), created_at=NOW()", (error, result) => {
            if (error) {
                throw error
            } else {
                let sql = "SELECT c.id, c.admin_id, c.employee_id, c.message, c.attachment, c.sender, c.datetime, a.name AS admin_name, a.profile_photo_path AS admin_profile_photo_path, e.name AS user_name, e.profile_photo_path AS user_profile_photo_path FROM chat_employee_admins c LEFT JOIN admins a ON (c.admin_id = a.id) LEFT JOIN employees e ON (c.employee_id = e.id) WHERE c.id = " + result.insertId;

                db.query(sql, (error, result) => {
                    if (!error) {
                        socket.broadcast.emit('sendChatToClientAdminAndEmployee', result);
                    }
                });
            }
        });
    });

    socket.on('disconnect', (socket) => {
        console.log('Disconnect');
    });
});

server.listen(3000, () => {
    console.log(port);
    console.log(`Server is running at ${port}`);
});
