diag-tools
==========

Image for debugging containers in a cluster environment.

This image contains useful commands for debugging like curl, ping, netcat, traceroute, mtr, dig... When it run with the default command, it prints information about the container and start a tiny web server that echo "Hello World".


## How to use it?

### With Docker

    $ docker run --rm lightcode/diag-tools
    Hostname: 99f2cb80c3ae

    ================================
    ip address
    ================================
    1: lo: <LOOPBACK,UP,LOWER_UP> mtu 65536 qdisc noqueue state UNKNOWN qlen 1
        link/loopback 00:00:00:00:00:00 brd 00:00:00:00:00:00
        inet 127.0.0.1/8 scope host lo
           valid_lft forever preferred_lft forever
    54: eth0@if55: <BROADCAST,MULTICAST,UP,LOWER_UP,M-DOWN> mtu 1500 qdisc noqueue state UP
        link/ether 02:42:ac:11:00:02 brd ff:ff:ff:ff:ff:ff
        inet 172.17.0.2/16 scope global eth0
           valid_lft forever preferred_lft forever

    ================================
    ip route
    ================================
    default via 172.17.0.1 dev eth0
    172.17.0.0/16 dev eth0  src 172.17.0.2

    ================================
    resolv.conf
    ================================
    nameserver 8.8.8.8
    nameserver 8.8.4.4

    ================================
    A webserver is listening on :80
    ================================
    2017/07/27 12:30:44 Server is listening on :80


To enter into the container:

    $ docker exec -it diag ash


### With Kubernetes

Check if deployments works:

    $ kubectl run diag --image=lightcode/diag-tools --port=80 --replicas=3
    $ kubectl expose deployment diag --type NodePort

Then, you can make a curl on this service, check if the network works.
