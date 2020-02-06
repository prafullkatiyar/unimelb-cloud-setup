from connect_nectar import ec2_my_conn

images = ec2_my_conn.get_all_images()

for image in images:
    print('Image ID: {}, Image name: {}'.format(image.id, image.name))