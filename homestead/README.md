# Laravel Homestead
## What is Vagrant and Homestead?
[Vagrant](http://vagrantup.com) is a tool to run one ore more virtual machines
 to create the whole environment, that may consist of several pieces
 (DB, one or more application server, cache instance, etc.)
 from plain-text environment description stored in repository - *Vagrantfile*. 

[Laravel Homestead](https://laravel.com/docs/homestead) is a vagrant image,
officially maintained by Laravel development team.
It contains everything to run Laravel application inside Vagrant box with minimal efforts. 
 

## Run and develop in isolated environment 
1. Install [VirtualBox](http://virtualbox.org) and [Vagrant](http://vagrantup.com)
2. 
```
$ cd team-development
$ vagrant up
```
This will create new VM, download and install all required dependencies inside that VM.
3. Wait for download and configuration process to complete (first run may take up to 30 min). 
4. Open [http://192.168.111.10](http://192.168.111.10)
 (or whatever IP you set in *Homestead.yaml* file)
5. *development* folder will be shared with this environment - all changes to files in this folder
6. Stop environment VM - to release runtime resources (CPU, RAM) temporary (if you want to continue work from same point later) 
```
vagrant halt
```
7. Continue work after you used *vagrant halt*
```
vagrant up
```
8. Destroy environment (when you don't need project VM anymore or to reset it from scratch)
```
vagrant destroy
```
