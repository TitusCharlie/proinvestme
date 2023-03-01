class person:
    def __init__(self,name,age):
        self.name=name
        self.age=age
    number_of_people = 0
    @classmethod
    def add_person(cls):
        return cls.number_of_people += 1

p1=person("sam", 24)
p2=person("dapa", 25)

print(person.add_person())