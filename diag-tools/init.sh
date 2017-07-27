#!/bin/sh

echo "Hostname: $(hostname)"
echo

echo "================================"
echo "ip address"
echo "================================"
ip a
echo

echo "================================"
echo "ip route"
echo "================================"
ip r
echo

echo "================================"
echo "resolv.conf"
echo "================================"
sed -e '/^$/d' -e '/^#/d' /etc/resolv.conf
echo

echo "================================"
echo "A webserver is listening on :80"
echo "================================"
exec /usr/bin/http-echo -listen=:80 -text='Hello World'
