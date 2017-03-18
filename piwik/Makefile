all: build

VERSION=3.0.2

build:
	docker build --build-arg PIWIK_VERSION=$(VERSION) -t lightcode/piwik:$(VERSION) .
