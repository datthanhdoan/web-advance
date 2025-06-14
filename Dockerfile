FROM ubuntu:latest
LABEL authors="ubuntu"

ENTRYPOINT ["top", "-b"]
