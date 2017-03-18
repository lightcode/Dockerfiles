all: build

REPO=lightcode/airlift
VERSION=0.3.1

release:
	docker push $(REPO):$(VERSION)
	docker tag $(REPO):$(VERSION) $(REPO):latest
	docker push $(REPO):latest

build:
	docker build --build-arg VERSION=$(VERSION) -t $(REPO):$(VERSION) .
