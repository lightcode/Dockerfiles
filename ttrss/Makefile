REPO = lightcode/ttrss
VERSION = 20170524
TTRSS_COMMIT = 78fee22415bb1656700551a1cc8895cb714b5334
THEME_FEEDLY_COMMIT = 89fc8742eceaf7cfaa83d9c0c311e06507159a2e


all: build

build:
	docker build \
		--pull \
		--rm \
		--build-arg TTRSS_COMMIT=$(TTRSS_COMMIT) \
		--build-arg THEME_FEEDLY_COMMIT=$(THEME_FEEDLY_COMMIT) \
		-t $(REPO):$(VERSION) .

release:
	docker push $(REPO):$(VERSION)
	docker tag $(REPO):$(VERSION) $(REPO):latest
	docker push $(REPO):latest
