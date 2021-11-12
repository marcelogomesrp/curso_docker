# curso_docker
[Curso de docker](https://youtu.be/ScmgXebitlQ)

# Xclock

## Build
```
docker build -t xclock . -f Dockerfile.xclock
```
## RUN
```
docker run -it --rm -e DISPLAY -v /tmp/.X11-unix:/tmp/.X11-unix --user="$(id --user):$(id --group)" xclock
```

# Gedit

## Build
```
docker build -t gedit . -f Dockerfile.gedit
```
## RUN
```
docker run -it --rm -e DISPLAY -v /tmp/.X11-unix:/tmp/.X11-unix --user="$(id --user):$(id --group)" gedit
```

# Firefox

## Build
```
docker build -t firefox . -f Dockerfile.firefox
```
## RUN
```
docker run -it --rm -e DISPLAY -v /tmp/.X11-unix:/tmp/.X11-unix --user="$(id --user):$(id --group)" firefox
```