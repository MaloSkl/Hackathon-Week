import {
  Box,
  Card,
  CardBody,
  Image,
  Heading,
  Badge,
  Text,
  HStack,
  Center,
} from "@chakra-ui/react";
import React, { useState } from "react";
import RenderIcon from "./RenderIcon";

const PersonCard = ({ person }) => {
  const [isHovered, setIsHovered] = useState(false);

  const proPhoto = person.picturePro
    ? person.picturePro
    : "/src/assets/blank.png";
  const funPhoto = person.pictureFun
    ? person.pictureFun
    : "/src/assets/blank.png";

  const borderColor = isHovered ? "#C5C2FF" : "#51767A";

  return (
    <Card
      borderRadius={10}
      overflow={"hidden"}
      backgroundColor="#3A424E"
      borderColor={borderColor}
      borderWidth="2px"
      transition="border-color 0.3s"
    >
      <Box
        position="relative"
        onMouseOver={() => setIsHovered(true)}
        onMouseOut={() => setIsHovered(false)}
      >
        <Image src={isHovered ? funPhoto : proPhoto} />
      </Box>
      <CardBody>
        <Heading textColor="white" fontSize="2xl">
          {person.firstName} {person.name}
        </Heading>
        <HStack textColor="white" justifyContent={"space-between"}>
          <Text>{person.job}</Text>
          <Badge borderRadius="4px" textColor="white" backgroundColor="#7F56D9">
            {person.agency}
          </Badge>
        </HStack>
      </CardBody>
    </Card>
  );
};

export default PersonCard;
