REPO = lightcode/piwik
VERSION = 3.0.4
RELEASE = 1
TAG = $(VERSION)-$(RELEASE)

all: build

build:
	docker build \
		--pull \
		--rm \
		--build-arg VERSION=$(VERSION) \
		-t $(REPO):$(TAG) .

release:
	docker push $(REPO):$(TAG)
	docker tag $(REPO):$(TAG) $(REPO):latest
	docker push $(REPO):latest
