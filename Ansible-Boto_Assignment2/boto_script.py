import boto.ec2
import time
import sys
from boto.ec2.regioninfo import RegionInfo


COOKIE = "goup13"
PASSWORD = "twitter"


def main(argv):
    nInstances = int(argv[1])

    while nInstances:
        region = RegionInfo(name='melbourne', endpoint='nova.rc.nectar.org.au')

        ec2_my_conn = boto.connect_ec2(
            aws_access_key_id='004aa9512eee4150b10a46e2abdcea6b',
            aws_secret_access_key='321e883a40e8471c82ab9a2697b63685',
            is_secure=True,
            region=region,
            port=8773,
            path='/services/Cloud',
            validate_certs=False
        )

        reservation = ec2_my_conn.run_instances(
            'ami-190a1773',
            key_name='PRIVATE_KEY',
            instance_type='m2.medium',
            security_groups=['CouchDB nodes', 'ssh', 'http'],
            placement='melbourne-np'
        )

        instance = reservation.instances[0]
        print('New instance with id: {}, was created.'.format(instance.id))

        vol = ec2_my_conn.create_volume(50, 'melbourne-np')
        print ('A volume with id: {}, has been created'.format(vol.id))

        status = instance.state
        while status != 'running':
            time.sleep(2)
            print ('The instance with id: {} is booting, please wait.'.format(instance.id))
            time.sleep(10)
            status = instance.update()

        print('The instance is ready')

        ec2_my_conn.attach_volume(vol.id, instance.id, '/dev/vdc')
        print ("volume with id{}, was attached to instance with id {}".format(vol.id, instance.id))

        #time.sleep(7)
        #snapshot = ec2_my_conn.create_snapshot(vol.id, 'instance_snapshot')
        #print ('snapshot {}, of volume {}, was created'.format(snapshot.id, vol.id))

        #new_vol = snapshot.create_volume('melbourne-np')
        #print ('creating volume from snapshot')

        #ec2_my_conn.delete_snapshot(snapshot.id)
        #print ('snapshot with id {}, was deleted'.format(snapshot.id))
        nInstances -= 1

    reservations = ec2_my_conn.get_all_reservations()

    INVENTORY_PATH = "couchdb-inventory"

    print('Index\tID\t\tInstance')
    for idx, res in enumerate(reservations):
        print('{}\t{}\t{}'.format(idx, res.id, res.instances))

    toWrite = ""
    for i in range(len(reservations)):
        print('\nID: {}\tIP {}\tPlacement {}'.format(
            reservations[i].id,
            reservations[i].instances[0].private_ip_address,
            reservations[i].instances[0].placement,
        ))
        if (i == 0):
            toWrite += '[nodes]\n' + str(reservations[i].instances[0].private_ip_address) + '\n'
        else:
            toWrite += str(reservations[i].instances[0].private_ip_address) + '\n'

    inventoryfile = open(INVENTORY_PATH, 'w+')
    inventoryfile.write(toWrite)
    inventoryfile.close()

    DEFAULTS_PATH = "roles/couchdb/defaults/main.yaml"

    defaultspath = open(DEFAULTS_PATH, 'w+')
    defaultspath.write("---\nCOOKIE: \""+ COOKIE + "\"\nN_NODES: " + argv[1] + "\nPASSWORD: \""+PASSWORD+"\"")


if __name__ == "__main__":
    main(sys.argv)