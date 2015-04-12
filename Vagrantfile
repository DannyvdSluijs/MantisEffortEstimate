
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.provider "virtualbox" do |v|
    v.name = "MantisEffortEstimate"
    v.memory = 512
    v.cpus = 1
  end

  config.vm.box = "hashicorp/precise64"

  config.vm.provision :shell, path: "vagrant/provisioning.sh"

  config.vm.network :forwarded_port, host: 8080, guest: 80

  config.vm.network "private_network", ip: "192.168.0.2"
  
  config.vm.synced_folder ".", "/var/www//EffortEstimate", type: "nfs"
end
