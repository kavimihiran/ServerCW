import mysql.connector
import logging
import os
from dotenv import load_dotenv
load_dotenv()

logging.basicConfig(level=logging.INFO)
# Create connection to MySQL database
connection = mysql.connector.connect(
    host=os.environ.get("DB_HOST"),
    port=os.environ.get("DB_PORT"),
    user=os.environ.get("DB_USERNAME"),
    password=os.environ.get("DB_PASSWORD"),
    database=os.environ.get("DB_NAME")
)

if connection.is_connected():
    print("Connected to DB")
else:
    print("Failed to connect to DB")

HOST = os.environ.get("DB_HOST")
PORT = os.environ.get("DB_PORT")
USER = os.environ.get("DB_USERNAME")
PASSWORD = os.environ.get("DB_PASSWORD")
DATABASE = os.environ.get("DB_NAME")


def validate_user(credentials: dict):
    try:
        my_db = mysql.connector.connect(
            host=HOST,
            port=PORT,
            user=USER,
            password=PASSWORD,
            database=DATABASE
        )
        
        logging.info("MySQL connection started")

        my_cursor = my_db.cursor()

        print("MySQL connection started")

        sql_query = "SELECT password,username FROM users WHERE username ='%s'" % credentials['username']

        my_cursor.execute(sql_query)

        data = my_cursor.fetchall()

        result = {}

        if len(data) != 0:
            password = data[0][0]

            if password == credentials['password']:
                result["result"] = "success"
                result["username"] = data[0][1]

            else:
                result["result"] = "unsuccessful"
                result["username"] = ""

        else:
            result["result"] = "unsuccessful"
            result["username"] = ""

        return result

    except mysql.connector.Error as error:
        print(f"ERROR- {error}")
        return 0

    finally:
        if my_db.is_connected():
            my_cursor.close()
            my_db.close()
            print("MySQL connection is closed")


def register_user(information: dict):
    try:
        my_db = mysql.connector.connect(
            host=HOST,
            port=PORT,
            user=USER,
            password=PASSWORD,
            database=DATABASE
        )
        logging.info("MySQL connection started")

        my_cursor = my_db.cursor()

        print("MySQL connection started")

        sql_insert_query = "INSERT INTO users (firstname,lastname,email,username,password) VALUES (%s, %s, %s, %s,%s)"
        insert_tuple = (
            information["firstName"], information["lastName"], information["email"], information["username"],information["password"])

        my_cursor.execute(sql_insert_query, insert_tuple)

        my_db.commit()

        result = {"result": "success"}

        return result

    except mysql.connector.errors.IntegrityError as i:
        logging.error(f"Integrity Error: {i}")
        result = {"result": "unsuccessful"}
        return result

    except mysql.connector.Error as error:
        logging.error(f"Error: {error}")
        print(f"ERROR- {error}")

        return 0

    finally:
        if my_db.is_connected():
            my_cursor.close()
            my_db.close()
            print("MySQL connection is closed")
            

