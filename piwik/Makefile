all: build

REPO=lightcode/piwik
VERSION=3.0.2

release:
	docker push $(REPO):$(VERSION)
	docker tag $(REPO):$(VERSION) $(REPO):latest
	docker push $(REPO):latest

build:
	docker build --build-arg PIWIK_VERSION=$(VERSION) -t $(REPO):$(VERSION) .
