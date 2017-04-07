REPO = lightcode/piwik
VERSION = 3.0.3

all: build

build:
	docker build --build-arg VERSION=$(VERSION) -t $(REPO):$(VERSION) .

release:
	docker push $(REPO):$(VERSION)
	docker tag $(REPO):$(VERSION) $(REPO):latest
	docker push $(REPO):latest
