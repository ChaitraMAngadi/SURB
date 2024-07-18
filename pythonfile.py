import gspread
from google.oauth2 import service_account
from google.oauth2.service_account import Credentials as ServiceAccountCredentials
import pandas as pd
import mysql.connector
import re
import json
from datetime import datetime



db_config = {
    'user': 'root',
    'password': '',
    'host': 'localhost',
    'database': 'absolute_new',
}
spreadsheet_id = '1KP1i7XpJCTEFZZ-S7TXzHgHGiEX3mQ2ZD0eWGH2gI1o'
worksheet_name = 'product_duplicate' 



connection = mysql.connector.connect(**db_config)
cursor = connection.cursor()

# Define the scopes
scopes = ["https://spreadsheets.google.com/feeds", "https://www.googleapis.com/auth/drive"]

# Load service account credentials from JSON file
credentials = service_account.Credentials.from_service_account_file('mystical-studio-406505-7fa6147070de.json', scopes=scopes)
gc = gspread.authorize(credentials)
worksheet = gc.open_by_key(spreadsheet_id).worksheet(worksheet_name)


data = worksheet.get_all_values()
columns = data[0]


column_names_products = ', '.join(data[0][:28])  # Adjust the range based on your data
insert_query_products = f"INSERT INTO products({column_names_products}) VALUES ({', '.join(['%s'] * 28)})"


# start_index_link_variant = 46
# end_index_link_variant = 57
# column_names_link_variant = ', '.join(data[0][start_index_link_variant:end_index_link_variant + 1])
# insert_query_link_variant = f"INSERT INTO link_variant({column_names_link_variant}) VALUES ({', '.join(['%s'] * (end_index_link_variant - start_index_link_variant + 1))})"
# start_index_link_variant = 46
# end_index_link_variant = 56

# Define the column names for link_variant table
# column_names_link_variant = ', '.join(data[0][start_index_link_variant:end_index_link_variant + 1])

# Define the INSERT query for link_variant table
# insert_query_link_variant = f"INSERT INTO link_variant({column_names_link_variant}) VALUES ({', '.join(['%s'] * (end_index_link_variant - start_index_link_variant + 1))})"




start_index_images=29
end_index_images=31
column_names_images = ', '.join(data[0][start_index_images:end_index_images])
insert_images = f"INSERT INTO product_images({column_names_images}) VALUES ({', '.join(['%s'] * (end_index_images - start_index_images))})"

start_index_filter=32
end_index_filter=34
column_names_filter =', '.join(data[0][start_index_filter:end_index_filter])
insert_filter = f"INSERT INTO product_filter({column_names_filter}) VALUES ({', '.join(['%s'] * (end_index_filter - start_index_filter))})"

start_index_add =34
end_index_add =37
column_name_add=', '.join(data[0][start_index_add:end_index_add])
insert_add = f"INSERT INTO add_variant({column_name_add}) VALUES ({', '.join(['%s'] * (end_index_add - start_index_add))})"





for row in data[1:]:
    # Insert data into the products table
    cursor.execute(insert_query_products, row[:28])
    last_inserted_id = cursor.lastrowid
    print(f"Inserted row with ID in products table: {last_inserted_id}")

    # Generate SEO URL and update the products table
    name = row[1]
    title = f"{last_inserted_id}_{name}"
    shop_name = re.sub(r'[^a-z0-9_-]', '', title.lower().replace(' ', '-'))
    print(f"Updating product_id {last_inserted_id} with seo_url: {shop_name}")
    update_query = "UPDATE products SET seo_url = %s WHERE id = %s"
    cursor.execute(update_query, (shop_name, last_inserted_id))
    connection.commit()

    # Process JSON data in column 52
    
    cursor.execute(insert_filter, row[start_index_filter:end_index_filter])
    filter_id = cursor.lastrowid
    print(f"Inserted row with ID in filter table: {filter_id}")
    updated_filter = "UPDATE product_filter SET product_id = %s WHERE id = %s"
    cursor.execute(updated_filter, (last_inserted_id, filter_id))
    connection.commit()

    cursor.execute(insert_add, row[start_index_add:end_index_add])
    add_id= cursor.lastrowid
    print(f"Inserted row with ID in add_variant table: {add_id}")
    updated_add = "UPDATE add_variant SET product_id = %s WHERE id = %s"
    cursor.execute(updated_add, (last_inserted_id, add_id))
    connection.commit()
    
    


    # Display all values in column 51
    column_index = 29
    column_values = worksheet.col_values(column_index)
    for value in column_values:
        try:
            data_list = json.loads(value)
            print(data_list)
        except json.JSONDecodeError as e:
            print(f"Error decoding JSON: {e}")
            continue  # Skip to the next iteration if JSON decoding fails
            

        for item in data_list:
            # Insert data into the link_variant table
            
            price = item.get("price")
            saleprice = item.get("saleprice")
            stock = item.get("stock")
            status = item.get("status")
            attributes = item.get("attributes")

            # Convert attributes to a JSON-formatted string
            jsondata = json.dumps(attributes)
            current_datetime = datetime.utcnow()
            timestamp = int(current_datetime.timestamp())

            print(timestamp)

            # Format the datetime object as a string in the specified format
            formatted_date = current_datetime.strftime("%Y-%m-%d %H:%M:%S")
            print(formatted_date)

            # Your SQL query
            insert_query = "INSERT INTO link_variant(product_id,price, saleprice, stock, jsondata, status,created_at) VALUES (%s,%s, %s, %s, %s, %s,%s)"
            query_params = (last_inserted_id,price, saleprice, stock, jsondata, status,timestamp)

            # Execute the query
            cursor.execute(insert_query, query_params)
            link_last_inserted_id = cursor.lastrowid
            connection.commit()

            # Update the product_id for the link_variant table
            # updated_link = "UPDATE link_variant SET product_id = %s WHERE id = %s"
            # cursor.execute(updated_link, (last_inserted_id1, link_last_inserted_id))
            
    cursor.execute(insert_images, row[start_index_images:end_index_images])
    image_id = cursor.lastrowid
    print(f"Inserted row with ID in product_images table: {image_id}")
    updated_images = "UPDATE product_images SET product_id = %s WHERE id = %s"
    cursor.execute(updated_images, (last_inserted_id, image_id))
    connection.commit()
    updated_images = "UPDATE product_images SET variant_id = %s WHERE id = %s"
    cursor.execute(updated_images, (link_last_inserted_id, image_id))
    connection.commit()

            



    


connection.commit()
cursor.close()
connection.close()
