import {
  Box,
  Card,
  CardBody,
  Image,
  Heading,
  Badge,
  Text,
  HStack,
} from "@chakra-ui/react";
import React, { useState } from "react";
import RenderIcon from "./RenderIcon";

const PersonCard = ({ person }) => {
  const [isHovered, setIsHovered] = useState(false);

  const proPhoto = person.photo_pro
    ? person.photo_pro
    : "/src/assets/blank.png";
  const funPhoto = person.photo_fun
    ? person.photo_fun
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
        <Heading fontSize="2xl">
          {person.prenom} {person.nom}
        </Heading>
        <HStack justifyContent={"space-between"}>
          <Text>{person.poste}</Text>
          <Badge borderRadius="4px" backgroundColor="#7F56D9">
            {person.agence}
          </Badge>
        </HStack>
      </CardBody>
    </Card>
  );
};

export default PersonCard;
