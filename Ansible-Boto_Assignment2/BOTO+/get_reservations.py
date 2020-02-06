from connect_nectar import ec2_my_conn
reservations = ec2_my_conn.get_all_reservations()

print('Index\tID\t\tInstance')
for idx, res in enumerate(reservations):
    print('{}\t{}\t{}'.format(idx, res.id, res.instances))

for i in range(len(reservations)):
    print('\nID: {}\tIP {}\tPlacement {}'.format(
        reservations[i].id,
        reservations[i].instances[0].private_ip_address,
        reservations[i].instances[0].placement,
    ))

