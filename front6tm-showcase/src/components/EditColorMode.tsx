import { HStack, Switch, Text, useColorMode } from "@chakra-ui/react";

const EditColorMode = () => {
  const { toggleColorMode, colorMode } = useColorMode();
  return (
    <HStack marginX={5}>
      <Switch isChecked={colorMode === "dark"} onChange={toggleColorMode} />
      <Text color="white">Dark Mode</Text>
    </HStack>
  );
};

export default EditColorMode;
  